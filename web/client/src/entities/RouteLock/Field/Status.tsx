import FiberManualRecordIcon from '@mui/icons-material/FiberManualRecord';
import withCustomComponentWrapper, {
    PropertyCustomFunctionComponent,
    PropertyCustomFunctionComponentProps
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { RouteLockPropertyList } from '../RouteLockProperties';

type HuntGroupsRelUserValues = RouteLockPropertyList<
    string | number | boolean
>;
type TargetGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<HuntGroupsRelUserValues>>;

const Status: TargetGhostType = (props): JSX.Element => {

    const { values } = props;
    const { open } = values;

    if (open === true) {
        return (<FiberManualRecordIcon style={{ color: 'green' }} />);
    }

    return (<FiberManualRecordIcon style={{ color: 'red' }} />);
}

export default withCustomComponentWrapper<HuntGroupsRelUserValues>(Status);