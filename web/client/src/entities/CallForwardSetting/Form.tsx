import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { PropertyList, ScalarProperty } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { foreignKeyGetter } from './foreignKeyGetter';
import User from '../User/User';
import Friend from '../Friend/Friend';
import CallForwardSetting from '../CallForwardSetting/CallForwardSetting';
import RetailAccount from '../RetailAccount/RetailAccount';
import { useStoreState } from 'store';

const Form = (props: EntityFormProps): JSX.Element => {

  const { entityService, row, match, properties } = props;
  const DefaultEntityForm = defaultEntityBehavior.Form;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const skip: Array<string> = [];
  if (aboutMe?.pbx) {
    skip.push(...[
      'cfwToRetailAccount',
      'residentialDevice',
    ]);
  }

  if (aboutMe?.residential) {
    skip.push(...[
      'cfwToRetailAccount',
      'extension',
    ]);
  }

  if (aboutMe?.retail) {
    skip.push(...[
      'residentialDevice',
      'extension',
      'voicemail',
    ]);
  }

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
    skip,
  });

  const newProperties = { ...properties };

  const targetType = { ...newProperties.targetType } as ScalarProperty;
  const targetTypeEnum = { ...(targetType?.enum || {}) };

  const callForwardType = { ...(newProperties?.callForwardType || {}) } as ScalarProperty;
  const callForwardTypeEnum = { ...(callForwardType?.enum || {}) };

  const userPath = match.path.includes(User.path);
  const friendPath = match.path.includes(Friend.path);
  const retailAccountPath = match.path.includes(RetailAccount.path);

  if (userPath) {

    delete newProperties.friend;
    delete newProperties.cfwToRetailAccount;
    delete newProperties.retailAccount;
    delete newProperties.residentialDevice;

  } else if (friendPath) {

    delete newProperties.user;
    delete newProperties.cfwToRetailAccount;
    delete newProperties.retailAccount;
    delete newProperties.residentialDevice;

  } else if (retailAccountPath) {

    delete newProperties.friend;
    delete newProperties.user;
    delete newProperties.residentialDevice;

    delete targetTypeEnum.extension;
    delete targetTypeEnum.voicemail;

    delete callForwardTypeEnum.noAnswer;
    delete callForwardTypeEnum.busy;

  } else if (match.path.includes(CallForwardSetting.path)) {

    delete newProperties.friend;
    delete newProperties.user;
  }

  targetType.enum = targetTypeEnum;
  newProperties.targetType = targetType;

  callForwardType.enum = callForwardTypeEnum;
  newProperties.callForwardType = callForwardType;

  entityService.replaceProperties(newProperties as PropertyList);

  const groups: Array<FieldsetGroups> = [
    {
      legend: '',
      fields: [
        'enabled',
        !aboutMe?.retail && 'callTypeFilter',
        aboutMe?.retail && 'ddi',
        'callForwardType',
        'noAnswerTimeout',
        'targetType',
        aboutMe?.pbx && 'extension',
        (aboutMe?.pbx || aboutMe?.residential) && 'voicemail',
        'numberCountry',
        'numberValue',
        aboutMe?.retail && 'cfwToRetailAccount',
      ],
    },
  ];

  return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
};

export default Form;