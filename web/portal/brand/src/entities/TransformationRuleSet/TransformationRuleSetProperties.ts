import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type TransformationRuleSetPropertyList<T> = {
  description?: T;
  internationalCode?: T;
  trunkPrefix?: T;
  areaCode?: T;
  nationalLen?: T;
  generateRules?: T;
  id?: T;
  name?: T;
  country?: T;
};

export type TransformationRuleSetProperties = TransformationRuleSetPropertyList<Partial<PropertySpec>>;
export type TransformationRuleSetPropertiesList = Array<TransformationRuleSetPropertyList<EntityValue | EntityValues>>;
