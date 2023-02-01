import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type TerminalModelPropertyList<T> = {
  description?: T;
  iden?: T;
  name?: T;
  genericUrlPattern?: T;
  specificUrlPattern?: T;
  genericTemplate?: T;
  specificTemplate?: T;
  id?: T;
};

export type TerminalModelProperties = TerminalModelPropertyList<
  Partial<PropertySpec>
>;
export type TerminalModelPropertiesList = Array<
  TerminalModelPropertyList<EntityValue | EntityValues>
>;
