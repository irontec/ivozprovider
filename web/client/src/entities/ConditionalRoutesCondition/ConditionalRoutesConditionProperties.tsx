import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type ConditionalRoutesConditionPropertyList<T> = {
    'conditionalRoute'?: T,
    'priority'?: T,
    'matchListIds'?: T,
    'scheduleIds'?: T,
    'calendarIds'?: T,
    'routeLockIds'?: T,
    'ConditionMatch'?: T,
    'locution'?: T,
    'routeType'?: T,
    'ivr'?: T,
    'huntGroup'?: T,
    'voicemailUser'?: T,
    'user'?: T,
    'numberCountry'?: T,
    'numberValue'?: T,
    'friendValue'?: T,
    'queue'?: T,
    'conferenceRoom'?: T,
    'extension'?: T,
    'target'?: T,
};

export type ConditionalRoutesConditionProperties = ConditionalRoutesConditionPropertyList<Partial<PropertySpec>>;
export type ConditionalRoutesConditionPropertiesList = Array<ConditionalRoutesConditionPropertyList<EntityValue|EntityValues>>;