UPDATE `Users` SET languageId=NULL WHERE languageId=(select languageId from Companies where id=Users.companyId);
