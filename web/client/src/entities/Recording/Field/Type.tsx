import _ from '@irontec/ivoz-ui/services/translations/translate';
import { RecordingPropertyList } from '../RecordingProperties';
import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

type RecordingValues = RecordingPropertyList<string | number>;
type TypeGhostType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<RecordingValues>>;

const Type: TypeGhostType = (props): JSX.Element => {

  const values = props.values;
  const type = _(values?.type as string || '');
  const recorder = values?.recorder;

  const response = recorder
    ? (<span>{type} ({recorder})</span>)
    : type;

  return (<span>{response}</span>);
};

export default withCustomComponentWrapper<RecordingValues>(Type);