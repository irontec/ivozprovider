import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type DomainPropertyList<T> = {
  domain?: T;
  id?: T;
};

export type DomainProperties = DomainPropertyList<Partial<PropertySpec>>;
export type DomainPropertiesList = Array<
  DomainPropertyList<EntityValue | EntityValues>
>;
