import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type TerminalManufacturerPropertyList<T> = {
  description?: T;
  iden?: T;
  name?: T;
  id?: T;
};

export type TerminalManufacturerProperties = TerminalManufacturerPropertyList<
  Partial<PropertySpec>
>;
export type TerminalManufacturerPropertiesList = Array<
  TerminalManufacturerPropertyList<EntityValue | EntityValues>
>;
