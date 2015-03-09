<?php
namespace Pyz\Zed\Catalog\Business\Model\Import\Product\Validator\Workflow\Definition;

use ProjectA\Zed\Catalog\Business\Model\Import\Product\Validator\Workflow\Definition\AbstractDefinition;
use ProjectA\Zed\Library\Workflow\TaskInterface;

class ValidateNewConfigProduct extends AbstractDefinition
{

    /**
     * @return TaskInterface[]
     */
    protected function getTasks()
    {
        return [
            $this->factory->createModelImportProductValidatorWorkflowTaskInsertValidateBaseFieldsTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskSetAttributeSetToContextTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateAttributeSetExistsTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateVarietyExistsTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskInsertValidateMandatoryGroupTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateUnknownFieldsTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateAttributeOptionsExistTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateCategoriesExistTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateProductOptionsExistTask(),
        ];
    }
}
