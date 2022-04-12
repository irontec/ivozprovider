import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type ConditionalRoutePropertyList<T> = {
    'name'?: T,
    'locution'?: T,
    'routetype'?: T,
    'ivr'?: T,
    'huntGroup'?: T,
    'voicemail'?: T,
    'user'?: T,
    'numberCountry'?: T,
    'numbervalue'?: T,
    'friendvalue'?: T,
    'queue'?: T,
    'conferenceRoom'?: T,
    'extension'?: T,
    'target'?: T,
};

export type ConditionalRouteProperties = ConditionalRoutePropertyList<Partial<PropertySpec>>;
export type ConditionalRoutePropertiesList = Array<ConditionalRoutePropertyList<EntityValue | EntityValues>>;