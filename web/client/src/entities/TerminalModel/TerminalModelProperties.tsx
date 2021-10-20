import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type TerminalModelPropertyList<T> = {
};

export type TerminalModelProperties = TerminalModelPropertyList<Partial<PropertySpec>>;
export type TerminalModelPropertiesList = Array<TerminalModelPropertyList<EntityValue | EntityValues>>;