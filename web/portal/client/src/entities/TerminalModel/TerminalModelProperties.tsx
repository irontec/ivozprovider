import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type TerminalModelPropertyList<T> = {
  id?: T;
  name?: T;
};

export type TerminalModelProperties = TerminalModelPropertyList<
  Partial<PropertySpec>
>;
export type TerminalModelPropertiesList = Array<
  TerminalModelPropertyList<EntityValue | EntityValues>
>;
