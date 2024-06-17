import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type CallAclRelMatchListPropertyList<T> = {
  id?: T;
  priority?: T;
  policy?: T;
  callAcl?: T;
  matchList?: T;
};

export type CallAclRelMatchListProperties = CallAclRelMatchListPropertyList<
  Partial<PropertySpec>
>;
export type CallAclRelMatchListPropertiesList = Array<
  CallAclRelMatchListPropertyList<EntityValue | EntityValues>
>;
