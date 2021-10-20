import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type DdiPropertyList<T> = {
    'ddi'?: T,
    'externalCallFilter'?: T,
    'routeType'?: T,
    'recordCalls'?: T,
    'displayName'?: T,
    'user'?: T,
    'ivr'?: T,
    'huntGroup'?: T,
    'fax'?: T,
    'conferenceRoom'?: T,
    'residentialDevice'?: T,
    'friendValue'?: T,
    'country'?: T,
    'language'?: T,
    'queue'?: T,
    'conditionalRoute'?: T,
    'retailAccount'?: T,
    'target'?: T,
};

export type DdiProperties = DdiPropertyList<Partial<PropertySpec>>;
export type DdiPropertiesList = Array<DdiPropertyList<EntityValue|EntityValues>>;