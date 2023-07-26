import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';

const Form = (props: EntityFormProps): JSX.Element | null => {
  const edit = props.edit || false;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['iden'],
    },
    {
      legend: '',
      fields: ['name'],
    },
    {
      legend: '',
      fields: ['description'],
    },
    {
      legend: '',
      fields: ['defaultCode'],
    },
    {
      legend: '',
      fields: ['extraArgs'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      readOnlyProperties={{ iden: edit, name: edit, description: edit }}
      groups={groups}
    />
  );
};

export default Form;
