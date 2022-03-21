import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type CallForwardSettingPropertyList<T> = {
    'user'?: T,
    'residentialDevice'?: T,
    'friend'?: T,
    'ddi'?: T,
    'retailAccount'?: T,
    'cfwToretailAccount'?: T,
    'callTypeFilter'?: T,
    'callForwardType'?: T,
    'targetType'?: T,
    'numberCountry'?: T,
    'numberValue'?: T,
    'extension'?: T,
    'voicemail'?: T,
    'noAnswerTimeout'?: T,
    'targetTypeValue'?: T,
    'enabled'?: T,
};

export type CallForwardSettingProperties = CallForwardSettingPropertyList<Partial<PropertySpec>>;
export type CallForwardSettingPropertiesList = Array<CallForwardSettingPropertyList<EntityValue|EntityValues>>;