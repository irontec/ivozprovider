import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {
  const DefaultEntityForm = defaultEntityBehavior.Form;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['name', 'description'],
    },

    {
      legend: '',
      fields: [
        {
          name: 'template',
          size: {
            md: 12,
            lg: 12,
            xl: 12,
          },
        },
        {
          name: 'templateHeader',
          size: {
            md: 12,
            lg: 12,
            xl: 12,
          },
        },
        {
          name: 'templateFooter',
          size: {
            md: 12,
            lg: 12,
            xl: 12,
          },
        },
      ],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
