import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type FaxPropertyList<T> = {
  'name'?: T,
  'email'?: T,
  'sendByEmail'?: T,
  'outgoingDdi'?: T,
};

export type FaxProperties = FaxPropertyList<Partial<PropertySpec>>;

export type FaxPropertiesList = Array<FaxPropertyList<EntityValue | EntityValues>>;