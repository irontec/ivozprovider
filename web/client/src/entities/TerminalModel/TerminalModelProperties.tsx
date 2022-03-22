import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type TerminalModelPropertyList<T> = {
};

export type TerminalModelProperties = TerminalModelPropertyList<Partial<PropertySpec>>;
export type TerminalModelPropertiesList = Array<TerminalModelPropertyList<EntityValue | EntityValues>>;