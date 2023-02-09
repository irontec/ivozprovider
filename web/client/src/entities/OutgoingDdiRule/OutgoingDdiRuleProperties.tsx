import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type OutgoingDdiRulePropertyList<T> = {
  attr?: T;
  name?: T;
  defaultAction?: T;
  forcedDdi?: T;
};

export type OutgoingDdiRuleProperties = OutgoingDdiRulePropertyList<
  Partial<PropertySpec>
>;
export type OutgoingDdiRulePropertiesList = Array<
  OutgoingDdiRulePropertyList<EntityValue | EntityValues>
>;
