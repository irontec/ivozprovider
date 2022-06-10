import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import {
  EntityValue,
  EntityValues,
} from "@irontec/ivoz-ui/services/entity/EntityService";

export type ResidentialDevicePropertyList<T> = {};

export type ResidentialDeviceProperties = ResidentialDevicePropertyList<
  Partial<PropertySpec>
>;
export type ResidentialDevicePropertiesList = Array<
  ResidentialDevicePropertyList<EntityValue | EntityValues>
>;
