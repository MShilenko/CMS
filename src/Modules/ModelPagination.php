<?php

namespace App\Modules;

use App\Exceptions\NotFoundException;
use App\Models\Setting;
use \Illuminate\Database\Eloquent\Collection;

class ModelPagination
{
    public const DEFAULT_ADMIN = 20;

    protected $object;
    protected $rowsCount;
    protected $paginationLimit;

    public function __construct(object $object)
    {
        $this->object = $object;
        $this->rowsCount = $object->count();
        $this->paginationLimit = Setting::getGeneralOption('posts_count');
    }

    /**
     * Get part of the output for pagination
     * @param  int|integer $number
     * @return Collection
     */
    public function simplePaginate(int $number = 0): Collection
    {
        if ($number !== 0) {
            $this->paginationLimit = $number;
        }

        return $this->object->skip($this->getSkip())->take($this->paginationLimit)->get();
    }

    /**
     * Get the number of query rows to skip
     * @return int
     */
    public function getSkip(): int
    {
        if ($this->getOffset($this->paginationLimit) + 1 > $this->rowsCount) {
            throw new NotFoundException(MSG_NOT_FOUND, 404);
        }

        return $this->getOffset($this->paginationLimit);
    }

    /**
     * Get offset value
     * @return int
     */
    public function getOffset(): int
    {
        return isset($_GET['page']) ? $this->paginationLimit * ($_GET['page'] - 1) : 0;
    }

    /**
     * Get the number of pagination pages
     * @return int
     */
    public function paginationCount(): int
    {
        $count = 0;

        if ($this->paginationLimit < $this->rowsCount) {
            $count = intdiv($this->rowsCount, $this->paginationLimit);
            $count = $this->rowsCount % $this->paginationLimit ? $count + 1 : $count;
        }

        return $count;
    }

    /**
     * Form the value of the pagination limit
     * @return integer
     */
    public function getAdminLimit(): int
    {
        $limit = 0;

        if ($_GET['on_page'] == 'all') {
            $limit = $this->rowsCount;
        }

        if (is_numeric($_GET['on_page'])) {
            $limit = $_GET['on_page'];
        }

        return $limit;
    }
}
