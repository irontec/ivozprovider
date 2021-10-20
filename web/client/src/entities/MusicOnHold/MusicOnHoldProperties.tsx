import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type MusicOnHoldPropertyList<T> = {
    'name'?: T,
    'originalFile'?: T,
};

export type MusicOnHoldProperties = MusicOnHoldPropertyList<Partial<PropertySpec>>;
export type MusicOnHoldPropertiesList = Array<MusicOnHoldPropertyList<EntityValue|EntityValues>>;