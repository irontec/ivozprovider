import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {
  const groups: Array<FieldsetGroups> = [
    {
      legend: '',
      fields: ['name'],
    },
    {
      legend: '',
      fields: ['timeIn', 'timeout'],
    },
    {
      legend: '',
      fields: [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
      ],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
