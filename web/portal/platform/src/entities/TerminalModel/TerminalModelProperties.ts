import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type TerminalModelPropertyList<T> = {
  iden?: T;
  name?: T;
  description?: T;
  genericUrlPattern?: T;
  specificUrlPattern?: T;
  genericTemplate?: T;
  specificTemplate?: T;
  id?: T;
  terminalManufacturer?: T;
};

export type TerminalModelProperties = TerminalModelPropertyList<
  Partial<PropertySpec>
>;
export type TerminalModelPropertiesList = Array<
  TerminalModelPropertyList<EntityValue | EntityValues>
>;
