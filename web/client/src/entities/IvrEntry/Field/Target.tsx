import withCustomComponentWrapper, {
    PropertyCustomFunctionComponent,
    PropertyCustomFunctionComponentProps
} from 'lib/services/form/Field/CustomComponentWrapper';
import { IvrEntryPropertyList } from '../IvrEntryProperties';

type HuntGroupsRelUserValues = IvrEntryPropertyList<
    string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HuntGroupsRelUserValues>>;

const Type: TargetGhostType = (props): JSX.Element => {

    const { values } = props;

    return (<span>{values.target}</span>);
}

export default withCustomComponentWrapper<HuntGroupsRelUserValues>(Type);