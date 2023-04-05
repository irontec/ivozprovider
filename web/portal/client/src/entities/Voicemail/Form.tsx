import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { foreignKeyGetter } from '../Queue/foreignKeyGetter';
import { useStoreState } from '../../store';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, edit } = props;

  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const readOnlyProperties = {
    name: edit || false,
    email: edit || false,
  };

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic configuration'),
      fields: ['enabled', 'name'],
    },
    {
      legend: _('Notification configuration'),
      fields: [
        'sendMail',
        aboutMe?.vpbx && 'email',
        aboutMe?.vpbx && 'attachSound',
      ],
    },
    {
      legend: _('Customization'),
      fields: [aboutMe?.vpbx && 'locution'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      fkChoices={fkChoices}
      groups={groups}
      readOnlyProperties={readOnlyProperties}
    />
  );
};

export default Form;
