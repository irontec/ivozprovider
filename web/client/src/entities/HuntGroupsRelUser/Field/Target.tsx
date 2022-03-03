import withCustomComponentWrapper, {
    PropertyCustomFunctionComponent,
    PropertyCustomFunctionComponentProps,
    CustomFunctionComponentContext
} from 'lib/services/form/Field/CustomComponentWrapper';
import { HuntGroupsRelUserPropertyList } from '../HuntGroupsRelUserProperties';
import User from '../../User/User';
import { CountryPropertyList } from 'entities/Country/CountryProperties';

type CountryProperty = CountryPropertyList<string>;

type HuntGroupsRelUserValues = HuntGroupsRelUserPropertyList<
    string | number | CountryProperty
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HuntGroupsRelUserValues>>;

const Type: TargetGhostType = (props): JSX.Element | null => {

    const { _context, choices } = props;
    let { values } = props;

    if (_context === CustomFunctionComponentContext.write) {

        if (!choices) {
            return null;
        }

        values = {
            ...values,
            ...choices,
        };
    }

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