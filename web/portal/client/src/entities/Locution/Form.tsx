import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {
  const edit = props.edit || false;

  const groups: Array<FieldsetGroups> = [
    {
      legend: '',
      fields: ['name', edit && 'recordingExtension'],
    },
    {
      legend: '',
      fields: ['originalFile'],
    },
    {
      legend: '',
      fields: [edit && 'status'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
