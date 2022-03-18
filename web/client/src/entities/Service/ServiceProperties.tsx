import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type ServicePropertyList<T> = {
};

export type ServiceProperties = ServicePropertyList<Partial<PropertySpec>>;
export type ServicePropertiesList = Array<ServicePropertyList<EntityValue | EntityValues>>;