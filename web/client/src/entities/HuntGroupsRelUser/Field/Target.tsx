import withCustomComponentWrapper, {
    PropertyCustomFunctionComponent,
    PropertyCustomFunctionComponentProps
} from 'lib/services/form/Field/CustomComponentWrapper';
import { HuntGroupsRelUserPropertyList } from '../HuntGroupsRelUserProperties';
import User from '../../User/User';
import { CountryPropertyList } from 'entities/Country/CountryProperties';

type CountryProperty = CountryPropertyList<string>;

type HuntGroupsRelUserValues = HuntGroupsRelUserPropertyList<
    string | number | CountryProperty
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HuntGroupsRelUserValues>>;

const Type: TargetGhostType = (props): JSX.Element => {

    const { values } = props;

    if (values.routeType === 'user') {
        return (
            <span>
                {User.toStr(values.user as Record<string, any>)}
            </span>
        );
    }

    const { numberCountry, numberValue } = values;

    return (
        <span>
            {(numberCountry as CountryProperty).countryCode} {numberValue}
        </span>
    );
}

export default withCustomComponentWrapper<HuntGroupsRelUserValues>(Type);