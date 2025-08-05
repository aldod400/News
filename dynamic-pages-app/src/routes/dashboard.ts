import { Router } from 'express';
import { renderAboutPage } from '../controllers/pages';
import { renderAdvisoryBoardPage } from '../controllers/pages';
import { renderContactUsPage } from '../controllers/pages';
import { renderPrivacyPolicyPage } from '../controllers/pages';

const router = Router();

router.get('/company/about', renderAboutPage);
router.get('/company/advisory-board', renderAdvisoryBoardPage);
router.get('/company/contact-us', renderContactUsPage);
router.get('/company/privacy-policy', renderPrivacyPolicyPage);

export default router;