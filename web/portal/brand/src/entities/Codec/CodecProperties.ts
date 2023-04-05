import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type CodecPropertyList<T> = {
  type?: T;
  iden?: T;
  name?: T;
  id?: T;
};

export type CodecProperties = CodecPropertyList<Partial<PropertySpec>>;
export type CodecPropertiesList = Array<
  CodecPropertyList<EntityValue | EntityValues>
>;
