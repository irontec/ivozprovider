import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type ConferenceRoomPropertyList<T> = {
    'attr'?: T,
    'name'?: T,
    'pinProtected'?: T,
    'pinCode'?: T,
    'maxMembers'?: T,
};

export type ConferenceRoomProperties = ConferenceRoomPropertyList<Partial<PropertySpec>>;
export type ConferenceRoomPropertiesList = Array<ConferenceRoomPropertyList<EntityValue|EntityValues>>;