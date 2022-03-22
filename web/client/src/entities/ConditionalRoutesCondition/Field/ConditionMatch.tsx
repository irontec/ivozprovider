import withCustomComponentWrapper, {
    PropertyCustomFunctionComponent,
    PropertyCustomFunctionComponentProps
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { ConditionalRoutesConditionPropertyList } from '../ConditionalRoutesConditionProperties';

type HuntGroupsRelUserValues = ConditionalRoutesConditionPropertyList<
    string | number | Array<string>
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HuntGroupsRelUserValues>>;

const Type: TargetGhostType = (props): JSX.Element | null => {

    const { values } = props;

    if (!values.conditionMatch) {
        return null;
    }

    const conditionMatch = (values.conditionMatch as string[]).join(', ');

    return (<span>{conditionMatch}</span>);
}

export default withCustomComponentWrapper<HuntGroupsRelUserValues>(Type);