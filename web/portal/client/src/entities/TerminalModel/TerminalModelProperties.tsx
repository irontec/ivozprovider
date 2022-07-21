import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type TerminalModelPropertyList<T> = Record<string, T>;

export type TerminalModelProperties = TerminalModelPropertyList<
  Partial<PropertySpec>
>;
export type TerminalModelPropertiesList = Array<
  TerminalModelPropertyList<EntityValue | EntityValues>
>;
