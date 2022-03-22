import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type ConferenceRoomPropertyList<T> = {
    'attr'?: T,
    'name'?: T,
    'pinProtected'?: T,
    'pinCode'?: T,
    'maxMembers'?: T,
};

export type ConferenceRoomProperties = ConferenceRoomPropertyList<Partial<PropertySpec>>;
export type ConferenceRoomPropertiesList = Array<ConferenceRoomPropertyList<EntityValue | EntityValues>>;