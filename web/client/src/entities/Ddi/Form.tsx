import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';
import { DdiPropertyList } from './DdiProperties';
import { foreignKeyGetter } from './foreignKeyGetter';
import RetailAccount from '../RetailAccount/RetailAccount';

const Form = (props: EntityFormProps): JSX.Element => {

  const { entityService, row, match } = props;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const retailAccountPath = match.path.includes(RetailAccount.path);

  const skip: Array<string> = [];
  if (!aboutMe?.vpbx) {
    skip.push(...[
      'user',
      'ivr',
      'huntGroup',
      'conditionalRoute',
      'conferenceRoom',
      'queue',
      'fax',
      'externalCallFilter',
    ]);
  }

  if (!aboutMe?.residential) {
    skip.push(...[
      'residentialDevice',
    ]);
  }

  if (!aboutMe?.retail) {
    skip.push(...[
      'retailAccount',
    ]);
  }

  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices: DdiPropertyList<any> = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
    skip,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Number data'),
      fields: [
        'country',
        'ddi',
        'displayName',
        'language',
      ],
    },
    !aboutMe?.retail && {
      legend: _('Filters data'),
      fields: [
        'externalCallFilter',
      ],
    },
    !retailAccountPath && {
      legend: _('Routing configuration'),
      fields: [
        'routeType',
        'user',
        'fax',
        'ivr',
        'huntGroup',
        'conferenceRoom',
        'friendValue',
        'queue',
        'residentialDevice',
        'conditionalRoute',
        'retailAccount',
      ],
    },
    {
      legend: _('Recording data'),
      fields: [
        aboutMe?.features.includes('recordings') && 'recordCalls',
      ],
    },
  ];

  return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
};

export default Form;