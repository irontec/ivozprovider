import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type CallAclPropertyList<T> = {
  attr?: T;
  name?: T;
  defaultPolicy?: T;
};

export type CallAclProperties = CallAclPropertyList<Partial<PropertySpec>>;
export type CallAclPropertiesList = Array<
  CallAclPropertyList<EntityValue | EntityValues>
>;
