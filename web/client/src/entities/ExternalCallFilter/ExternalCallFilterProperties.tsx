import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type ExternalCallFilterPropertyList<T> = {
    'name'?: T,
    'welcomeLocution'?: T,
    'holidayLocution'?: T,
    'outOfScheduleLocution'?: T,
    'holidayEnabled'?: T,
    'holidayTargetType'?: T,
    'holidayNumberCountry'?: T,
    'holidayNumberValue'?: T,
    'holidayExtension'?: T,
    'holidayVoicemail'?: T,
    'outOfScheduleEnabled'?: T,
    'outOfScheduleTargetType'?: T,
    'outOfScheduleNumberCountry'?: T,
    'outOfScheduleNumberValue'?: T,
    'outOfScheduleExtension'?: T,
    'outOfScheduleVoicemail'?: T,
    'scheduleIds'?: T,
    'calendarIds'?: T,
    'whiteListIds'?: T,
    'blackListIds'?: T,
    'holidayTarget'?: T,
    'outOfScheduleTarget'?: T,
};

export type ExternalCallFilterProperties = ExternalCallFilterPropertyList<Partial<PropertySpec>>;

export type ExternalCallFilterPropertiesList = Array<ExternalCallFilterPropertyList<EntityValue | EntityValues>>;
