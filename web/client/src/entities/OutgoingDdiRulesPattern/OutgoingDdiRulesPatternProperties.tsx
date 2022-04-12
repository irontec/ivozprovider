import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type OutgoingDdiRulesPatternPropertyList<T> = {
  'outgoingDdiRule'?: T,
  'type'?: T,
  'prefix'?: T,
  'matchList'?: T,
  'action'?: T,
  'forcedDdiStr'?: T,
  'forcedDdi'?: T,
  'priority'?: T,
  'rule'?: T,
};

export type OutgoingDdiRulesPatternProperties = OutgoingDdiRulesPatternPropertyList<Partial<PropertySpec>>;
export type OutgoingDdiRulesPatternPropertiesList = Array<OutgoingDdiRulesPatternPropertyList<EntityValue | EntityValues>>;