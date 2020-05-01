<?php


namespace Phobo\TestPublish\Editables;

use Phobo\TestPublish\Editables\EditableModel;

class EditableRepository
{
    protected $locale;

    function __construct()
    {
        $this->locale = \App::getLocale();
    }

    public function getStatuses()
    {
        return [
            EditableModel::STATUS_ACTIVE => [
                'label' => 'Active',
                'value' => EditableModel::STATUS_ACTIVE,
            ],
            EditableModel::STATUS_INACTIVE => [
                'label' => 'Inactive',
                'value' => EditableModel::STATUS_INACTIVE,
            ],
        ];
    }

    public function getLookupStatuses()
    {
        return array_values($this->getStatuses());
    }

}
