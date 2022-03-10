import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type IvrEntryPropertyList<T> = {
    'ivr'?: T,
    'entry'?: T,
    'welcomeLocution'?: T,
    'routeType'?: T,
    'numberCountry'?: T,
    'numberValue'?: T,
    'extension'?: T,
    'voicemail'?: T,
    'conditionalRoute'?: T,
    'target'?: T,
};

export type IvrEntryProperties = IvrEntryPropertyList<Partial<PropertySpec>>;

export type IvrEntryPropertiesList = Array<IvrEntryPropertyList<EntityValue | EntityValues>>;