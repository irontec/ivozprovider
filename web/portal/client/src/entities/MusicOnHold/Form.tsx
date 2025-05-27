import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';

const Form = (props: EntityFormProps): JSX.Element => {
  const edit = props.edit || false;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['name'],
    },
    {
      legend: '',
      fields: ['originalFile', edit && 'encodedFile'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
