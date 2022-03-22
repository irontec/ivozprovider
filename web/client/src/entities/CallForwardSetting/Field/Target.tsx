import withCustomComponentWrapper, {
    PropertyCustomFunctionComponent,
    PropertyCustomFunctionComponentProps
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { CallForwardSettingPropertyList } from '../CallForwardSettingProperties';

type HuntGroupsRelUserValues = CallForwardSettingPropertyList<
    string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HuntGroupsRelUserValues>>;

const Type: TargetGhostType = (props): JSX.Element => {

    const { values } = props;

    return (<span>{values.targetTypeValue}</span>);
}

export default withCustomComponentWrapper<HuntGroupsRelUserValues>(Type);