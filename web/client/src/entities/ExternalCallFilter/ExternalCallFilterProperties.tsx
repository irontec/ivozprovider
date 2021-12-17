import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type ExternalCallFilterPropertyList<T> = {
    'name'?: T,
    'welcomeLocution'?: T,
    'holidayLocution'?: T,
    'outOfScheduleLocution'?: T,
    'holidayTargetType'?: T,
    'holidayNumberCountry'?: T,
    'holidayNumberValue'?: T,
    'holidayExtension'?: T,
    'holidayVoiceMailUser'?: T,
    'outOfScheduleTargetType'?: T,
    'outOfScheduleNumberCountry'?: T,
    'outOfScheduleNumberValue'?: T,
    'outOfScheduleExtension'?: T,
    'outOfScheduleVoiceMailUser'?: T,
    'scheduleIds'?: T,
    'calendarIds'?: T,
    'whiteListIds'?: T,
    'blackListIds'?: T,
    'holidayTarget'?: T,
    'outOfScheduleTarget'?: T,
};

export type ExternalCallFilterProperties = ExternalCallFilterPropertyList<Partial<PropertySpec>>;

export type ExternalCallFilterPropertiesList = Array<ExternalCallFilterPropertyList<EntityValue | EntityValues>>;