import LockIcon from "@mui/icons-material/Lock";
import LockOpenIcon from "@mui/icons-material/LockOpen";
import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from "@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper";
import { RouteLockPropertyList } from "../RouteLockProperties";

type RouteLockValues = RouteLockPropertyList<string | number | boolean>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<RouteLockValues>
>;

const Status: TargetGhostType = (props): JSX.Element => {
  const { values } = props;
  const { open } = values;

  if (open === true) {
    return <LockOpenIcon />;
  }

  return <LockIcon />;
};

export default withCustomComponentWrapper<RouteLockValues>(Status);
