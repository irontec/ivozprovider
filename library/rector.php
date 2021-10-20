<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
// CodeQuality
use Rector\CodeQuality\Rector\{
    Class_\CompleteDynamicPropertiesRector,
    If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector,
    ClassMethod\DateTimeToDateTimeInterfaceRector,
    Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector,
    Name\FixClassCaseSensitivityNameRector,
    FuncCall\IntvalToTypeCastRector,
    FunctionLike\RemoveAlwaysTrueConditionSetInConstructorRector,
    Catch_\ThrowWithPreviousExceptionRector,
};
//PHP 7.0 - 8.0
use Rector\Php70\Rector\{
    FunctionLike\ExceptionHandlerTypehintRector,
    FuncCall\RandomFunctionRector,
    Ternary\TernaryToNullCoalescingRector,
};
use Rector\Php71\Rector\ClassConst\PublicConstantVisibilityRector;
use Rector\Php73\Rector\{
    FuncCall\ArrayKeyFirstLastRector,
    BooleanOr\IsCountableRector,
    FuncCall\JsonThrowOnErrorRector,
};
use Rector\Php74\Rector\{
    FuncCall\ArraySpreadInsteadOfArrayMergeRector,
    Property\RestoreDefaultNullToNullableTypePropertyRector,
};
use Rector\Php80\Rector\{
    FuncCall\ClassOnObjectRector,
    Catch_\RemoveUnusedVariableInCatchRector,
    NotIdentical\StrContainsRector,
    Identical\StrEndsWithRector,
    Identical\StrStartsWithRector,
};
// EarlyReturn
use Rector\EarlyReturn\Rector\{
    If_\ChangeIfElseValueAssignToEarlyReturnRector,
    Foreach_\ChangeNestedForeachIfsToEarlyContinueRector,
    If_\ChangeNestedIfsToEarlyReturnRector,
    If_\ChangeOrIfContinueToMultiContinueRector,
    If_\ChangeOrIfReturnToEarlyReturnRector,
    Return_\PreparedValueToEarlyReturnRector,
    If_\RemoveAlwaysElseRector,
    Foreach_\ReturnAfterToEarlyOnBreakRector,
    Return_\ReturnBinaryAndToEarlyReturnRector,
};
// TypeDeclaration
use Rector\TypeDeclaration\Rector\{
    Closure\AddClosureReturnTypeRector,
    ClassMethod\ParamTypeByMethodCallTypeRector,
    ClassMethod\ParamTypeByParentCallTypeRector,
    Param\ParamTypeFromStrictTypedPropertyRector,
    ClassMethod\ReturnTypeFromReturnNewRector,
    ClassMethod\ReturnTypeFromStrictTypedCallRector,
    ClassMethod\ReturnTypeFromStrictTypedPropertyRector,
};

return static function (ContainerConfigurator $containerConfigurator): void {
    $PENDING_OR_UNSAFE_RECTORS = [
        // CodeQuality
        Rector\CodeQuality\Rector\Ternary\UnnecessaryTernaryExpressionRector::class,

        //PHP 7.0 - 8.0
        Rector\Php74\Rector\Assign\NullCoalescingOperatorRector::class,
        Rector\Php74\Rector\Property\TypedPropertyRector::class,
        Rector\Php80\Rector\Class_\StringableForToStringRector::class,
        Rector\Php80\Rector\FunctionLike\UnionTypesRector::class,
        Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector::class,
        Rector\Php80\Rector\ClassMethod\OptionalParametersAfterRequiredRector::class,

        // EarlyReturn
        Rector\EarlyReturn\Rector\If_\ChangeAndIfToEarlyReturnRector::class,

        // Privatization
        Rector\Privatization\Rector\Class_\FinalizeClassesWithoutChildrenRector::class,
        Rector\Privatization\Rector\Property\PrivatizeFinalClassPropertyRector::class,

        // TypeDeclaration
        Rector\TypeDeclaration\Rector\FunctionLike\ParamTypeDeclarationRector::class,
        Rector\TypeDeclaration\Rector\FunctionLike\ReturnTypeDeclarationRector::class,
        Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector::class,
        Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector::class,
    ];

    $services = $containerConfigurator->services();

    $containerConfigurator->import(\Rector\PHPUnit\Set\PHPUnitSetList::PHPUNIT_90);

    // CodeQuality
    $services->set(CompleteDynamicPropertiesRector::class);
    $services->set(ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class);
    $services->set(DateTimeToDateTimeInterfaceRector::class);
    $services->set(ArrayKeyExistsTernaryThenValueToCoalescingRector::class);
    $services->set(FixClassCaseSensitivityNameRector::class);
    $services->set(IntvalToTypeCastRector::class);
    $services->set(RemoveAlwaysTrueConditionSetInConstructorRector::class);
    $services->set(ThrowWithPreviousExceptionRector::class);

    //PHP 7.0 - 8.0
    $services->set(PublicConstantVisibilityRector::class);
    $services->set(ExceptionHandlerTypehintRector::class);
    $services->set(RandomFunctionRector::class);
    $services->set(TernaryToNullCoalescingRector::class);
    $services->set(ArrayKeyFirstLastRector::class);
    $services->set(IsCountableRector::class);
    $services->set(JsonThrowOnErrorRector::class);
    $services->set(ArraySpreadInsteadOfArrayMergeRector::class);
    $services->set(RestoreDefaultNullToNullableTypePropertyRector::class);
    $services->set(ClassOnObjectRector::class);
    $services->set(RemoveUnusedVariableInCatchRector::class);
    $services->set(StrContainsRector::class);
    $services->set(StrEndsWithRector::class);
    $services->set(StrStartsWithRector::class);

    // EarlyReturn
    $services->set(ChangeIfElseValueAssignToEarlyReturnRector::class);
    $services->set(ChangeNestedForeachIfsToEarlyContinueRector::class);
    $services->set(ChangeNestedIfsToEarlyReturnRector::class);
    $services->set(ChangeOrIfContinueToMultiContinueRector::class);
    $services->set(ChangeOrIfReturnToEarlyReturnRector::class);
    $services->set(PreparedValueToEarlyReturnRector::class);
    $services->set(RemoveAlwaysElseRector::class);
    $services->set(ReturnAfterToEarlyOnBreakRector::class);
    $services->set(ReturnBinaryAndToEarlyReturnRector::class);

    // TypeDeclaration
    $services->set(AddClosureReturnTypeRector::class);
    $services->set(ParamTypeByMethodCallTypeRector::class);
    $services->set(ParamTypeByParentCallTypeRector::class);
    $services->set(ParamTypeFromStrictTypedPropertyRector::class);
    $services->set(ReturnTypeFromReturnNewRector::class);
    $services->set(ReturnTypeFromStrictTypedCallRector::class);
    $services->set(ReturnTypeFromStrictTypedPropertyRector::class);
};
