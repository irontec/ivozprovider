import withCustomComponentWrapper, {
    PropertyCustomFunctionComponent,
    PropertyCustomFunctionComponentProps
} from 'lib/services/form/Field/CustomComponentWrapper';
import { HolidayDatePropertyList } from '../HolidayDateProperties';

type HuntGroupsRelUserValues = HolidayDatePropertyList<
    string | number
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HuntGroupsRelUserValues>>;

const Type: TargetGhostType = (props): JSX.Element => {

    const { values } = props;

    return (<span>{values.target}</span>);
}

export default withCustomComponentWrapper<HuntGroupsRelUserValues>(Type);