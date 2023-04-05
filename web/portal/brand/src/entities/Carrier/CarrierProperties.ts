import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type CarrierPropertyList<T> = {
  description?: T;
  name?: T;
  balance?: T;
  calculateCost?: T;
  id?: T;
  transformationRuleSet?: T;
  currency?: T;
  proxyTrunk?: T;
  acd?: T;
  asr?: T;
  statusIcon?: T;
  mediaRelaySet?: T;
};

export type CarrierProperties = CarrierPropertyList<Partial<PropertySpec>>;
export type CarrierPropertiesList = Array<
  CarrierPropertyList<EntityValue | EntityValues>
>;
