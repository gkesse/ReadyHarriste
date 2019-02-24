//===============================================
function openDatabaseTab(obj, name) {
	GDatabase.Instance().openDatabaseTab(obj, name);
}
//===============================================
function openDatabaseFile(obj, type) {
	GDatabase.Instance().openDatabaseFile(obj, type);
}
//===============================================
function openDatabaseLink(obj) {
	GDatabase.Instance().openDatabaseLink(obj);
}
//===============================================
function updateDatabase(obj) {
	GDatabase.Instance().updateDatabase(obj);
}
//===============================================
function createDatabase(obj) {
	GDatabase.Instance().createDatabase(obj);
}
//===============================================
function readDatabaseFile() {
	GDatabase.Instance().readFile();
}
//===============================================
function updateDatabaseFile() {
	GDatabase.Instance().updateFile();
}
//===============================================
function createDatabaseFile() {
	GDatabase.Instance().createFile();
}
//===============================================
function deleteDatabaseFile() {
	GDatabase.Instance().deleteFile();
}
//===============================================
