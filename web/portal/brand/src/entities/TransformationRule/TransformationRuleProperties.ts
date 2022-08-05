import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type TransformationRulePropertyList<T> = {
  type?: T;
  description?: T;
  priority?: T;
  matchExpr?: T;
  replaceExpr?: T;
  id?: T;
  transformationRuleSet?: T;
};

export type TransformationRuleProperties = TransformationRulePropertyList<Partial<PropertySpec>>;
export type TransformationRulePropertiesList = Array<TransformationRulePropertyList<EntityValue | EntityValues>>;
