<?php
namespace Smart\OSC\Api;

use Smart\OSC\Api\Data\OptionInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;

interface OptionRepositoryInterface 
{
    public function save(OptionInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(OptionInterface $page);

    public function deleteById($id);
}
