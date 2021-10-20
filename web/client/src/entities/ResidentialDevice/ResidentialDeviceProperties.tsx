import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type ResidentialDevicePropertyList<T> = {
};

export type ResidentialDeviceProperties = ResidentialDevicePropertyList<Partial<PropertySpec>>;
export type ResidentialDevicePropertiesList = Array<ResidentialDevicePropertyList<EntityValue | EntityValues>>;