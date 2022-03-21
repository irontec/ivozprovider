import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type IvrPropertyList<T> = {
    'name'?: T,
    'welcomeLocution'?: T,
    'noInputLocution'?: T,
    'errorLocution'?: T,
    'successLocution'?: T,
    'timeout'?: T,
    'maxDigits'?: T,
    'allowExtensions'?: T,
    'excludedExtensionIds'?: T,
    'noInputRouteType'?: T,
    'noInputNumberCountry'?: T,
    'noInputNumberValue'?: T,
    'noInputExtension'?: T,
    'noInputVoicemail'?: T,
    'errorRouteType'?: T,
    'errorNumberCountry'?: T,
    'errorNumberValue'?: T,
    'errorExtension'?: T,
    'errorVoicemail'?: T,
    'noInputTarget'?: T,
    'errorTarget'?: T,
};

export type IvrProperties = IvrPropertyList<Partial<PropertySpec>>;

export type IvrPropertiesList = Array<IvrPropertyList<EntityValue | EntityValues>>;