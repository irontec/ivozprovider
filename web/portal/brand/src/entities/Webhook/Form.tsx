import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const formik = useFormHandler(props);

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Information'),
      fields: ['name', 'description', 'uri'],
    },
    {
      legend: _('Events'),
      fields: ['eventStart', 'eventRing', 'eventAnswer', 'eventEnd'],
    },
    {
      legend: '',
      fields: ['template'],
    },
  ];

  return <DefaultEntityForm {...props} formik={formik} groups={groups} />;
};

export default Form;
